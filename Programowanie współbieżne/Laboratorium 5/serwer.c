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

typedef struct statystyka
{
    int polaczony;
    int aktywny;
    int PID;
    int figura;
    int punkty;
    int pozycja;
} Statystyka;

struct dane
{
    int id;
    Wiadomosc wiadomosc;
    int wielkosc_wiadomosci;
    int gracze;
    int tura;
    Statystyka statystyka[MAX_LICZBA_GRACZY];
} dane;

void utworz()
{
    int id = ftok("serwer.c",1234);
    dane.id = msgget(id,IPC_CREAT|0666);
    if(dane.id == -1)
    {
        printf(" --- BLAD TWORZENIA KOLEJKI KOMUNIKATOW ---\n");
        exit(-1);
    }
    else
    {
        printf(" --- SERWER DZIALA ---\n");
        dane.wielkosc_wiadomosci = sizeof(Wiadomosc) - sizeof(long);
        dane.tura = 0;
    }
}

void zamknij(int nr_syg)
{
    int i;
    for(i=0;i<MAX_LICZBA_GRACZY;i++)
    {
        if(dane.statystyka[i].PID != 0)
        {
            dane.wiadomosc.mtype = dane.statystyka[i].PID;
            dane.wiadomosc.typ = ROZLACZONY;
            if(msgsnd(dane.id,&dane.wiadomosc,dane.wielkosc_wiadomosci,0)!=0)
            {
                printf(" --- NIE UDALO SIE WYSLAC WIADOMOSCI DO GRACZA: %d ---\n",dane.wiadomosc.PID);
            }
            else
            {
                printf(" --- POMYSLNIE WYSLANO WIADOMOSC DO GRACZA: %d ---\n",dane.wiadomosc.PID);
            }
        }
    }
    if(msgctl(dane.id,IPC_RMID,NULL)==-1)
    {
        printf("\n --- USUWANIE KOLEJKI KOMUNIKATOW - BLAD! ---\n");
    }
    else
    {
        printf("\n --- SERWER ZAMKNIETO POMYSLNIE ---\n");
    }
    exit(0);
}

void polacz()
{
    printf(" --- GRACZ CHCE DOLACZYC DO SERWERA ---\n");
    if(dane.gracze == MAX_LICZBA_GRACZY)
    {
        printf(" --- BRAK MIEJSC ---\n");
        dane.wiadomosc.mtype = dane.wiadomosc.PID;
        dane.wiadomosc.typ = ROZLACZONY;
        if(msgsnd(dane.id,&dane.wiadomosc,dane.wielkosc_wiadomosci,0)!=0)
        {
            printf(" --- NIE UDALO SIE WYSLAC WIADOMOSCI DO GRACZA: %d ---\n",dane.wiadomosc.PID);
        }
    }
    else
    {
        int i;
        for(i=0;i<MAX_LICZBA_GRACZY;i++)
        {
            if(dane.statystyka[i].PID == 0)
            {
                printf(" --- GRACZ - PID: %d DOLACZA DO SERWERA ---\n",dane.wiadomosc.PID);
                dane.statystyka[i].PID = dane.wiadomosc.PID;
                dane.statystyka[i].polaczony = true;
                break;
            }
        }
        dane.gracze++;
        printf(" --- AKTUALNA ILOSC GRACZY: %d ---\n",dane.gracze);
    }
}

void rozlacz()
{
    int i;
    for(i=0;i<MAX_LICZBA_GRACZY;i++)
    {
        if(dane.statystyka[i].PID == dane.wiadomosc.PID)
        {
            printf(" --- GRACZ - PID: %d ODLACZYL SIE OD SERWERA ---\n",dane.wiadomosc.PID);
            dane.statystyka[i].PID=0;
            dane.statystyka[i].polaczony = false;
            dane.statystyka[i].punkty = 0;
            dane.statystyka[i].pozycja = 0;
            break;
        }
    }
    dane.gracze--;
}

void wyslij_wyniki()
{
    int i;
    for(i=0;i<MAX_LICZBA_GRACZY;i++)
    {
        if(dane.statystyka[i].aktywny == true)
        {
            dane.wiadomosc.mtype = dane.statystyka[i].PID;
            dane.wiadomosc.punkty = dane.statystyka[i].punkty;
            dane.wiadomosc.pozycja = dane.statystyka[i].pozycja;
            dane.wiadomosc.gracze = dane.gracze;
            dane.wiadomosc.typ = WYNIKI;
            if (msgsnd(dane.id, &dane.wiadomosc, dane.wielkosc_wiadomosci, 0) != 0)
            {
                printf(" --- NIE UDALO SIE WYSLAC WIADOMOSCI DO GRACZA: %d ---\n", dane.wiadomosc.PID);
            }
            dane.statystyka[i].aktywny = false;
        }
    }
}

void sortuj_wyniki() 
{
    int i, j;
    for (i = 0; i < MAX_LICZBA_GRACZY; i++) 
    {
        if (dane.statystyka[i].PID != 0) 
        {
            Statystyka tmp;
            int max = i;
            for (j = i; j < MAX_LICZBA_GRACZY; j++) 
            {
                if (dane.statystyka[i].PID != 0) 
                {
                    if (dane.statystyka[max].punkty < dane.statystyka[j].punkty)
                    {
                        max = j;
                    }
                }
            }
            if (dane.statystyka[i].punkty < dane.statystyka[max].punkty) 
            {
                memcpy(&tmp, &dane.statystyka[i], sizeof(dane.statystyka[i]));
                memcpy(&dane.statystyka[i], &dane.statystyka[max], sizeof(dane.statystyka[i]));
                memcpy(&dane.statystyka[max], &tmp, sizeof(dane.statystyka[i]));
            }
        }
    }
    printf("\n --- STATYSTYKI ---\n");
    int pozycja = 1;
    for (i = 0; i < MAX_LICZBA_GRACZY; i++) 
    {
        if (dane.statystyka[i].aktywny == true && dane.statystyka[i].PID != 0) 
        {
            dane.statystyka[i].pozycja = pozycja++;
            printf(" --- GRACZ:%d ||| POZYCJA: %d ||| PUNKTY: %d ---\n", dane.statystyka[i].PID, dane.statystyka[i].pozycja, dane.statystyka[i].punkty);
        }
    }
}

void licz_punkty() 
{
    int licz_kamien = 0;
    int licz_papier = 0;
    int licz_nozyce = 0;
    int i;
    for (i = 0; i < MAX_LICZBA_GRACZY; i++) 
    {
        if (dane.statystyka[i].aktywny == true) 
        {
            if (dane.statystyka[i].figura == KAMIEN) 
            {
                licz_kamien++;
            }
            if (dane.statystyka[i].figura == PAPIER) 
            { 
                licz_papier++;
            }
            if (dane.statystyka[i].figura == NOZYCZKI) 
            {
                licz_nozyce++;
            }
        }
    }
    for (i = 0; i < MAX_LICZBA_GRACZY; i++) 
    {
        if (dane.statystyka[i].aktywny == true) 
        {
            int punkty = 0;
            if (dane.statystyka[i].figura == KAMIEN) 
            {
                punkty = licz_nozyce - licz_papier;
                dane.statystyka[i].punkty += punkty;
            }

            else if (dane.statystyka[i].figura == PAPIER) 
            {
                punkty = licz_kamien - licz_nozyce;
                dane.statystyka[i].punkty += punkty;   
            }

            else if (dane.statystyka[i].figura == NOZYCZKI) 
            {
                punkty = licz_papier - licz_kamien;
                dane.statystyka[i].punkty += punkty;
            }
            printf(" --- GRACZ - ID %d ZDOBYL: %d PKT! ---\n", dane.statystyka[i].PID, punkty);
        }
    }
}

int main(void)
{
    signal(SIGINT,zamknij);
    utworz();
    while (1) 
    {
        sleep(10);
        dane.tura++;
        int gracze = 0;
        printf(" --- RUNDA NUMER: %d ---\n", dane.tura);
        while (msgrcv(dane.id, &dane.wiadomosc, dane.wielkosc_wiadomosci, DO_SERWERA, IPC_NOWAIT) == dane.wielkosc_wiadomosci) 
        {
            if (dane.wiadomosc.typ == POLACZONY) 
            {
                polacz();
            }
            else if (dane.wiadomosc.typ == ROZLACZONY) 
            { 
                rozlacz();
            }
            else 
            {
                int i;
                for (i = 0; i < MAX_LICZBA_GRACZY; i++) {
                    if (dane.statystyka[i].PID == dane.wiadomosc.PID) 
                    {
                        dane.statystyka[i].figura = dane.wiadomosc.figura;
                        dane.statystyka[i].aktywny = true;
                        switch (dane.statystyka[i].figura) 
                        {
                            case KAMIEN:
                                printf(" --- GRACZ %d: KAMIEN! --- \n", dane.statystyka[i].PID);
                                break;

                            case PAPIER:
                                printf(" --- GRACZ %d: PAPIER! --- \n", dane.statystyka[i].PID);
                                break;
                            
                            case NOZYCZKI:
                                printf("--- GRACZ %d: NOZYCE! --- \n", dane.statystyka[i].PID);
                                break;
                        }  
                        gracze++;
                    }
                }
            }
        }
        if (gracze == 0)
        {
            printf(" --- BRAK GRACZY W TEJ RUNDZIE! ---\n");
        }
        else if (gracze == 1) 
        {
            printf(" --- W TEJ RUNDZIE TYLKO 1 GRACZ NA SERWERZE ---\n");
            dane.wiadomosc.mtype = dane.wiadomosc.PID;
            dane.wiadomosc.typ = BRAK_GRACZY;
            if (msgsnd(dane.id, &dane.wiadomosc, dane.wielkosc_wiadomosci, 0) != 0)
            {
                printf("--- NIE UDALO SIE WYSLAC WIADOMOSCI DO GRACZA: %d ---\n", dane.wiadomosc.PID);
            }
        }
        else 
        {
            printf("--- W TEJ RUNDZIE ZALOGOWALA SIE WYSTARCZAJACA LICZBA GRACZY ---\n");
            licz_punkty();
            sortuj_wyniki();
            wyslij_wyniki();
        }
    }
}


