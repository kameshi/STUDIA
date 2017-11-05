#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <stdio.h>
#include <stdlib.h>
#include <wait.h>
#include <errno.h>
#include <string.h>
#include <unistd.h>

#define FIFO1 "/tmp/fifo.1"

extern int errno;

void stworzFIFO()
{
	if(mknod(FIFO1,0666|S_IFIFO,0)<0)
	{
		perror("[PISANIE] Nie mozna stworzyc FIFO!\n");
		unlink(FIFO1);
		exit(0);
	}
	else
	{
		printf("[PISANIE] Pomyslnie utworzono FIFO!\n");
	}
}

int otworzFIFO()
{
	int flaga1 = O_WRONLY;
	int flaga2 = O_NDELAY;
	int deskryptor = open(FIFO1, flaga1);
	if(deskryptor < 0)
	{
		perror("Nie mozna otworzyc FIFO do pisania!");
		unlink(FIFO1);
		exit(0);
	}
	else
	{
		printf("[PISANIE] Otwarto FIFO do pisania!\n");
		return deskryptor;
	}
}	

void piszDoFIFO(int fifo)
{	
	char buffor[] = "Ala ma kota a kot ma ale";
	int n = write(fifo,buffor,strlen(buffor));
	if(strlen(buffor) != n)
	{
		perror("[PISANIE] Blad zapisu do FIFO!\n");
	}
	else
	{
		printf("[PISANIE] Pomyslnie zapisno do FIFO!\n");
	}
}	

int main(void)
{
	stworzFIFO();
	int fifo = otworzFIFO();
	if(fifo > 0)
	{
		piszDoFIFO(fifo);
	}
	else return 0;
}
