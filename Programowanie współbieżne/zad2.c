#include <stdio.h>
#include <stdlib.h>
#include <sys/wait.h>
#include <sys/types.h>
#include <string.h>
#include <unistd.h>

#define MAXLINE 1024
#define MAXBUFFOR 10

int main(void)
{
	int pipe_server[2];
	int pipe_client[2];
	int childpid;
	if(pipe(pipe_server)<0)
	{
		perror("Wystapil blad utworzenia PIPE dla serwera!\n");
	}
	else
	{
		printf("Pomyslnie utworzono PIPE - SERWER\n");
	}
	if(pipe(pipe_client)<0)
	{
		perror("Wystapil blad utworzenia PIPE dla klienta!\n");
	}
	else
	{
		printf("Pomyslnie utworzono PIPE - KLIENT\n");
	}
	if((childpid=fork())==-1)
	{
		perror("Nie moge forknac!\n");
	}
	else 
	{
		if (childpid == 0)
		{
			close(pipe_server[0]);
			close(pipe_client[1]);
			int status = 0;
			char line[MAXLINE];
			int n = read(pipe_client[0],line,sizeof(line));
			if(n<=0)
			{
				perror("Blad odczytu (read) serwera!\n");
			}
			else
			{
				line[n-1]='\0';
			}
			FILE *file = fopen(line,"r");
			if(file == NULL)
			{
				printf("[SERWER] Brak pliku!\n");
				status = -1;
				write(pipe_server[1],&status,sizeof(status));
			}
			else
			{
				printf("[SERWER] Plik istnieje! Odczytuje plik linia po linii i zapisuje do lacza!\n");
				char buffor[MAXBUFFOR];
				write(pipe_server[1],&status,sizeof(status));
				while(fgets(buffor,sizeof(buffor),file)!=NULL)
				{
					write(pipe_server[1],buffor,sizeof(buffor));
				}
			}	
		}
		else
		{
			close(pipe_server[1]);
			close(pipe_client[0]);
			char line[MAXLINE];
			printf("[KLIENT] Podaj nazwe pliku: ");
			fgets(line,sizeof(line),stdin);
			if(write(pipe_client[1],line,strlen(line))!=strlen(line))
			{
				perror("[KLIENT] Blad zapisu (write) klienta!");
			}
			char buffor[MAXBUFFOR];
			int status;
			read(pipe_server[0],&status,sizeof(status));
			if(status == -1)
			{
				printf("[KLIENT] Nie mozna otworzyc pliku! Podano zla nazwe pliku!\n");	
			}
			else
			{
				printf("[KLIENT] Odczyt zawartosci bufora od [SERWERA]:\n");
				while(read(pipe_server[0],buffor,sizeof(buffor))>0)
				{
					write(1,buffor,strlen(buffor));
				}
				printf("[KLIENT] Zakonczono odczyt bufora.\n");
			}
			wait(NULL);
		}
	}
	return 0;
}
	
		
