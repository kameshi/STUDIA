/*
# W przypadku wybrania opcji "1" semafor zostaje opuszczony.
# W przypadku wybrania opcji "2" semafor zostaje podniesiony. 

# Poprzez dodanie do struktury tablicowej op_lock wartości {0,1,0}
# nie można podnieść semafora więcej niż jeden raz. 
# Chcąc opuścić semafor z wartością 0 zostanie zwrócony błąd
# "Resource temporarily unavailable" ponieważ użyto znacznika
# operacji IPC_NOWAIT.
*/

#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/sem.h>

#define PERMS 0666

static struct sembuf op_lock[2] = {0,0,0,0,1,0};

static struct sembuf op_unlock[1] = {0,-1,IPC_NOWAIT};

void blokuj(int semid)
{
    if(semop(semid,&op_lock[0],2)<0)
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