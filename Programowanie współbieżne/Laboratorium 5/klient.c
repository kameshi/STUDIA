#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <time.h>
#include <signal.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/msg.h>

#define KAMIEN 0
#define PAPIER 1
#define NOZYCZKI 2
#define POLACZONY 3
#define ROZLACZONY 4
#define DO_SERWERA 5
#define BRAK_GRACZY 6
#define WYNIKI 7
#define ZAMKNIJ_SERWER 8
#define ROZGRYWKA 9
#define MAX_LICZBA_GRACZY 10
#define true 1
#define false 0

typedef struct wiadomosc
{
    long mtype;
    int typ;
    int gracze;
    int PID;
    int figura;
    int punkty;
    int pozycja;
} Wiadomosc;

struct dane
{
    int id;
    Wiadomosc wiadomosc;
    int wielkosc_wiadomosci;
} dane;

void utworz()
{
    dane.wielkosc_wiadomosci=sizeof(Wiadomosc)-sizeof(long);
    int id = ftok("serwer.c",1234);
    dane.id = msgget(id,0);
    if(dane.id!=-1)
    {
        printf(" --- LACZE Z SERWEREM ---\n");
    }
    else
    {
        printf(" --- NIE UDALO SIE POLACZYC Z SERWEREM ---\n");
        exit(-1);
    }
    dane.wiadomosc.mtype = DO_SERWERA;
    dane.wiadomosc.typ = POLACZONY;
    dane.wiadomosc.PID = getpid();
    if(msgsnd(dane.id,&dane.wiadomosc,dane.wielkosc_wiadomosci,0)==0)
    {
        printf(" --- POMYSLNIE POLACZONO Z SERWEREM ---\n");
    }
    else
    {
        printf(" --- NIE UDALO SIE POLACZYC Z SERWEREM ---\n");
    }
}

void zakoncz()
{
    dane.wiadomosc.mtype = DO_SERWERA;
    dane.wiadomosc.PID = getpid();
    dane.wiadomosc.typ = ROZLACZONY;
    if(msgsnd(dane.id,&dane.wiadomosc,dane.wielkosc_wiadomosci,0)==0)
    {
        printf("\n--- ODLACZONO OD SERWERA! KONIEC ROZGRYWKI! ---");
    }
    else
    {
        printf("\n--- NIE UDALO SIE ODLACZYC OD SERWERA! ---");
    }
    exit(0);
}

void odbierz()
{
    if(msgrcv(dane.id,&dane.wiadomosc,dane.wielkosc_wiadomosci,getpid(),0)==dane.wielkosc_wiadomosci)
    {
        if(dane.wiadomosc.typ == WYNIKI)
        {
            printf(" --- KONIEC TURY! ---\n");
            printf(" --- REZULTATY: ---\n");
            printf(" ------------------\n");
            printf("PUNKTY: %d\n",dane.wiadomosc.punkty);
            printf("ILOSC GRACZY: %d\n",dane.wiadomosc.pozycja);
            printf("MIEJSCE: %d\n",dane.wiadomosc.gracze);
        }
        if(dane.wiadomosc.typ == ROZLACZONY)
        {
            printf(" --- SERWER ZAKONCZYL DZIALANIE ---\n");
            exit(0);
        }
    }
    else
    {
        printf(" --- NIE UDALO SIE POBRAC KOMUNIKATU ---\n");
    }
}

int wybor_figury()
{
    int symbol;
    do
    {
        printf("\nWYBIERZ ATRYBUT: ");
        printf("0. KAMIEN --- 1. PAPIER --- 2. NOZYCE\n");
        scanf("%d",&symbol);
    } while(symbol>2 || symbol <0);
    if(symbol==0)
    {
        printf("Wybrano: KAMIEN.\n");
    }
    if(symbol==1)
    {
        printf("Wybrano: PAPIER.\n");
    }
    if(symbol==2)
    {
        printf("Wybrano: NOZYCE.\n");
    }
    return symbol;
}

int main(void)
{
    signal(SIGINT,zakoncz);
    utworz();
    sleep(2);
    while(1)
    {
        dane.wiadomosc.mtype = DO_SERWERA;
        dane.wiadomosc.PID = getpid();
        dane.wiadomosc.figura = wybor_figury();
        dane.wiadomosc.typ = ROZGRYWKA;
        msgsnd(dane.id,&dane.wiadomosc,dane.wielkosc_wiadomosci,0);
        odbierz();
    }
}



