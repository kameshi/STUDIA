#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <fcntl.h>
#include <signal.h>
#include <errno.h>
#include <sys/types.h>
#include <sys/stat.h>

#define FIFO1 "/tmp/fifo.1"
#define FIFO2 "/tmp/fifo.2"
#define PRAWA 0666
#define ROZMIAR_BUFORA 1024
#define KONIEC "STOP"

extern int errno;
int fifo_zapis;
int PID_potomek;

void obsluga_sygnalu(int nr_syg)
{
    write(fifo_zapis,KONIEC,sizeof(KONIEC));
    exit(0);
}

void stworz_kolejki()
{
    if(access(FIFO1,F_OK)!=-1 && access(FIFO1,F_OK)!=-1)
    {
        printf("[KLIENT 2] Kolejki juz istnieja - stworzone przez [KLIENT 1].\n");
    }
    else
    {
        if(mknod(FIFO1,PRAWA|S_IFIFO,0) == -1)
        {
            perror("[KLIENT 2] Nie mozna stworzyc kolejki FIFO1!\n");
        }
        else
        {
            printf("[KLIENT 2] Stworzono kolejke FIFO1.\n");
        }
        if(mknod(FIFO2,PRAWA|S_IFIFO,0) == -1)
        {
            perror("[KLIENT 2] Nie mozna stworzyc kolejki FIFO2!\n");
        }
        else
        {
            printf("[KLIENT 2] Stworzono kolejke FIFO2.\n");
        }
    }
}

void usun_kolejki()
{
    unlink(FIFO1);
    unlink(FIFO2);
}

void czytaj_kolejke()
{
    int fifo = open(FIFO1,O_RDONLY);
    if(fifo<0)
    {
        perror("[KLIENT 2] Nie mozna otworzyc kolejki FIFO1 do czytania!\n");
        exit(-1);
    }
    else
    {
        printf("[KLIENT 2] Pomyslnie otwarto kolejke FIFO1 do czytania!\n");
    }
    char bufor[ROZMIAR_BUFORA];
    while(strcmp(bufor,KONIEC)!=0)
    {
        int n = read(fifo,bufor,sizeof(bufor));
        if(n<=0)
        {
            perror("[KLIENT 2] Blad odczytu z kolejki FIFO1!\n");
        }
        else
        {
            bufor[n]='\0';
            if(strcmp(KONIEC,bufor)==0)
            {
                printf("[KLIENT 1] odlaczyl sie od komunikacji!\n");
            }
            printf("[KLIENT 1]: %s",bufor);
        }
    }
    usun_kolejki();
}

void pisz_do_kolejki()
{
    fifo_zapis = open(FIFO2,O_WRONLY);
    if(fifo_zapis<0)
    {
        perror("[KLIENT 2] Nie mozna otworzyc kolejki FIFO2 do pisania!\n");
        exit(-1);
    }
    else
    {
        printf("[KLIENT 2] Pomyslnie otwarto kolejke FIFO2 do pisania!\n");
    }
    char bufor[ROZMIAR_BUFORA];
    while(1)
    {
        fgets(bufor,sizeof(bufor),stdin);
        int n = write(fifo_zapis,bufor,strlen(bufor));
        if(strlen(bufor)!=n)
        {
            perror("[KLIENT 2] Nie udalo sie zapisac wiadomosci do kolejki FIFO2!\n");
        }
    }
}

int main(void)
{
    signal(SIGINT,obsluga_sygnalu);
    stworz_kolejki();
    if((PID_potomek = fork()) < 0)
    {
        perror("[KLIENT 2] Nie moge forknac!\n");
    }
    else
    {
        if(PID_potomek == 0)
        {
            pisz_do_kolejki();
            exit(0);
        }
        else
        {
            czytaj_kolejke();
            kill(PID_potomek,SIGKILL);
        }
    }
    return 0;
}

