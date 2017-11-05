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
#define BUFFOR 24

extern int errno;

int otworzFIFO()
{
    /*int fifo = open(FIFO1, O_RDONLY);*/
	int fifo = open(FIFO1, O_RDONLY|O_NDELAY);
	if(fifo < 0)
	{
		perror("Nie mozna otworzyc FIFO do czytania!");
		exit(0);
	}
	else
	{
		printf("[CZYTANIE] Otwarto FIFO do czytania!\n");
		return fifo;
	}
}

void czytajFIFO(int fifo)
{	
	char buffor[BUFFOR];
	int n = read(fifo,buffor,sizeof(buffor));
	if(n<0)
	{
		perror("[CZYTANIE] Nie mozna odczytac danych z FIFO!\n");
	}
	else
	{
		buffor[n] = '\0';
		write(1,buffor,n);
		printf("\n");
	}
}
	
int main(void)
{
	int fifo = otworzFIFO();
	if(fifo > 0)
	{
		czytajFIFO(fifo);
	}
	else return 0;
}