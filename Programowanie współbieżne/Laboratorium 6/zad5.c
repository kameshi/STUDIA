#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/sem.h>


int main(void)
{
    int semid = -1;
    if((semid = semget(ftok("/tmp",0),1,IPC_CREAT | 0666))<0)
    {
        perror("[BLAD!] Wystapil blad tworzenia semafora!\n");
    }
    else
    {
        printf("[STWORZONO SEMAFOR O ID: %d]\n",semid);
        system("ipcs | grep 666");
    }
    if(semctl(semid,0,IPC_RMID,0)<0)
    {
        perror("[BLAD!] Nie udalo sie usunac semafora!\n");
    }
    else
    {
        printf("[USUNIETO SEMAFOR O ID: %d]\n",semid);
        system("ipcs | grep 666");
    }
}