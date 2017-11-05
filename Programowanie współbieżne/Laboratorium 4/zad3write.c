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

int otworzFIFO()
{
    int fifo = open(FIFO1, O_WRONLY);
	/*int fifo = open(FIFO1, O_WRONLY|O_NDELAY);*/
	if(fifo < 0)
	{
		perror("Nie mozna otworzyc FIFO do pisania!");
		exit(0);
	}
	else
	{
		printf("[PISANIE] Otwarto FIFO do pisania!\n");
		return fifo;
	}
}	

void piszFIFO(int fifo)
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
	int fifo = otworzFIFO();
	if(fifo > 0)
	{
		piszFIFO(fifo);
	}
	else return 0;
}
