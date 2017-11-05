#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <wait.h>
#include <errno.h>
#include <signal.h>

#define FIFO1 "/tmp/fifo.1"
#define FIFO2 "/tmp/fifo.2"
#define WYJSCIE "KONIEC"

int PID_potomek;
int PID_rodzic;
int fifo_pisanie;

void obsluga_zakonczenia_potomka(int nr)
{
    exit(0);
}

void obsluga_zakonczenia_procesow(int nr)
{
    if(getpid() == PID_potomek)
    {
        char bufor[] = "KONIEC";
        int n = write(fifo_pisanie,bufor,strlen(bufor));
        if(strlen(bufor)!=n)
        {
            perror("[KLIENT 2] Blad zapisu do fifo!\n");
        }
        exit(0);
    }
    else if(getpid() == PID_rodzic)
    {
        wait(NULL);
        exit(0);
    }
}

int main(void)
{
    signal(SIGINT, obsluga_zakonczenia_procesow);
    int childpid;
    if((childpid = fork())==-1)
    {
        perror("[KLIENT 2] Nie moge forknac!\n");
        exit(1);
    }
    else
    {
        if(childpid == 0)
        {
            signal(SIGUSR1,obsluga_zakonczenia_potomka);
            PID_potomek = getpid();
            int fifo = open(FIFO2,O_WRONLY);
            if(fifo < 0)
            {
                perror("[KLIENT 2] Nie mozna otworzyc kolejki FIFO2 do pisania!\n");
            }
            else
            {
                printf("[KLIENT 2] Otwarto kolejke FIFO2 do pisania!\n");
                fifo_pisanie = fifo;
            }
            char bufor[1024];
            while(1)
            {
                fgets(bufor,sizeof(bufor),stdin);
                int n = write(fifo,bufor,strlen(bufor));
                if(strlen(bufor) != n)
                {
                    perror("[KLIENT 2] Blad zapisu do FIFO2!\n");
                }
            }
        }
        else
        {
            signal(SIGUSR1,SIG_IGN);
            PID_rodzic = getpid();
            int fifo = open(FIFO1,O_RDONLY);
            if(fifo < 0)
            {
                perror("[KLIENT 2] Nie mozna otworzyc kolejki FIFO1 do czytania!\n");
            }
            char bufor[1024];
            while(1)
            {
                int n = read(fifo,bufor,sizeof(bufor));
                if(n<=0)
                {
                    perror("[KLIENT 2] Blad odczytu z FIFO1!\n");
                }
                else
                {
                    bufor[n]='\0';
                    if(strcmp(WYJSCIE,bufor)==0)
                    {
                        printf("Odlaczyl sie [KLIENT 1]!\n");
                        break;
                    }
                    printf("[KLIENT 1]:");
                    printf("%s",bufor);
                }
            }
            kill(PID_potomek,SIGUSR1);
            wait(NULL);
            exit(0);
        }
    }
    exit(0);
    return 0;
}
