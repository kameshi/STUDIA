/*
1. Co się dzieje gdy wykonamy operacje V (podniesienie) za pierwszym razem?

# Semafor zostanie podniesiony. Zmiana wartości z 0 na 1. 

Co się stanie gdy wykonamy operacje V za drugim razem?

# Semafor ponownie został podniesiony. Zmiana wartości z 1 na 2. 

Ile razy możemy teraz wykonać operację P (opuszczenie)?

# Semafor możemy opuścić tyle razy, ile go podnieślimy, czyli 2. 
# Przy trzecim podniesieniu 

Otworzyć drugą konsolę i uruchomić nasz program, podnieść semafor, co się stało na pierwszym terminalu?

# Na pierwszej konsoli opuszczamy semafor. Program oczekuje, ponieważ wartość nie może być >0.
# Na drugiej konsoli uruchamiamy ten sam program. Wybieramy opcję podniesienia semafora.
# Semafor się podnosi (wynik na konsoli 2), lecz na konsoli 1 semafor opuszcza się, więc
# z wartości 1 przechodzi na wartość 0 natychmiastowo. Wartość semafora ostatecznie wynosi 0.

Opuścić semafor w pierwszym terminalu, co się stało?

# Program ponownie został zablokowany, ponieważ wartość semafora wynosi 0 i nie może być ujemna. 

Otworzyć trzeci terminal i podnieść semafor, czy na obu terminalach doszło do odblokowania?

# Po podniesieniu semafora na konsoli 3 został odblokowany semafor na konsoli 1, ponieważ
# tylko tam oczekiwano. 

Na trzecim terminalu jeszcze raz podnieść semafor

# Po ponownym podniesieniu wartość semafora wynosi 1. 

Gdy wszystkie terminale odblokowane wyjść przez 0.

# Powiodło się. 

Komendą ipcs sprawdzić czy semafor został w systemie.

# Semafor pozostaje w systemie. 

Komendą ipcrm -s usunąć semafor z systemu

# Powiodło się. 

Zmodyfikować tablicę operacji tak by operacja opuszczenia semafora była nie blokująca (IPC_NOWAIT)

# static struct sembuf op_lock[1] = {0,-1,IPC_NOWAIT};

Uruchomić program i spróbować opuścić semafor podnieść go po czym znowu opuścić.

# Chcąc opuścić semafor program zwraca komunikat "[BLAD!] Wystapil blad lokowania semafora!" 
# ponieważ program nie oczekuje, aż wartość semafora będzie wynosić >0 z powodu 
# użycia IPC_NOWAIT. Następnie podniesie oraz opuszczenie działało już prawidłowo.  

Wyjść i usunąć semafor, można usunąć IPC_NOWAIT

# Powiodło się. 

Uruchomić program podnieść kilka razy semafor i wyjść (nawet przez ^C)

# Podniesiono semafor 5 razy, więc jego wartość wynosi obecnie 5. 

Nie usuwać semafora, uruchomić program jeszcze raz tym razem próbując opuścić semafor. Czy stan semafora został zapamiętany?

# Stan semafora został zapamiętany. Opuszczono 5 razy, więc jego obecna wartość wynosi 0. 

Wprowadzić modyfikacje do tablic operacji polegającą na dodaniu opcji SEM_UNDO

# static struct sembuf op_lock[1] = {0,-1,SEM_UNDO};
# static struct sembuf op_unlock[1] = {0,1,0};

Usunąć semafor, skompilować i uruchomić program.

# Usunięto, skompilowano, uruchomiono. 

Powtórnie podnieść kilka razy semafor i wyjść

# Powiodło się. 

Uruchomić i spróbować opuścić semafor. Czy udało nam się zapamiętać ten stan?

# Chcąc opuścić semafor program zawiesza się w oczekiwaniu na wartość >0.
# Jego stan nie został zapamiętany, ponieważ użyto znacznika operacji SEM_UNDO, który
# cofa wszelkie zmiany na semaforze po wyjściu z programu. 
*/

#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/sem.h>

#define PERMS 0666

static struct sembuf op_lock[1] = {0,-1,0};

static struct sembuf op_unlock[1] = {0,1,0};

void blokuj(int semid)
{
    if(semop(semid,&op_lock[0],1)<0)
    {
        perror("[BLAD!] Wystapil blad lokowania semafora!\n");
    }
    else
    {
        printf("[OPUSZCZONY]\n");
    }
}

void odblokuj(int semid)
{
    if(semop(semid,&op_unlock[0],1)<0)
    {
        perror("[BLAD!] Wystapil blad odlokowania semafora!\n");
    }
    else
    {
        printf("[PODNIESIONY]\n");
    }
}

int main(void)
{
    int semid = -1;
    int co;
    int jeszcze;
    if((semid = semget(ftok("/tmp",0),1,IPC_CREAT | PERMS))<0)
    {
        perror("[BLAD!] Wystapil blad tworzenia semafora!\n");
    }
    else
    {
        printf("[STWORZONO SEMAFOR]\n");
    }
    printf("### PODAJ POLECENIE ###\n");
    printf("### 1 - PODNIES SEMAFOR ## 2 - OPUSC SEMAFOR ## 0 - WYJSCIE ###");
    for(jeszcze=1;jeszcze;)
    {
        scanf("%d",&co);
        printf("[WYBÓR OPCJI NR: %d]\n",co);
        switch(co)
        {
            case 2:
            {
                printf("[PRZED BLOKUJ()] %d\n",semctl(semid,0,GETVAL,0));
                blokuj(semid);
                printf("[PO BLOKUJ()] %d\n",semctl(semid,0,GETVAL,0));
                break;
            }
            case 1:
            {
                printf("[PRZED ODBLOKUJ()] %d\n",semctl(semid,0,GETVAL,0));
                odblokuj(semid);
                printf("[PO ODBLOKUJ()] %d\n",semctl(semid,0,GETVAL,0));
                break;
            }
            case 0:
            {
                jeszcze = 0;
                break;
            }
            default:
            {
                printf("[BLAD] Nie rozpoznana komenda!\n");
            }
        }
    }
}