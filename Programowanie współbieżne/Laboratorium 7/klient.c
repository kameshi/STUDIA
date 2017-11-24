#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/shm.h>
#include <sys/sem.h>
#include <signal.h>

static struct sembuf op_lock_1[1] = {{0,-1,0}};
static struct sembuf op_unlock_2[1] = {{1,1,0}};

int semid;
int shmid;
char *shmp;

void lock_sem_1(int semid)
{
    if(semop(semid,&op_lock_1[0],1)<0)
    {
        perror("[KLIENT] Blad blokowania semafora 1!\n");
    }
    else
    {
        printf("[KLIENT] Zblokowano semafor 1\n");
    }
}

void unlock_sem_2(int semid)
{
    if(semop(semid,&op_unlock_2[0],1)<0)
    {
        perror("[KLIENT] Blad odblokowania semafora 2!\n");
    }
    else
    {
        printf("[KLIENT] Odlokowano semafor 2\n");
    }
}

int create_shared_memory()
{
    shmid = shmget(ftok("serwer.c",3),sizeof(int),0666);
    if(shmid == -1)
    {
        perror("[KLIENT] Blad tworzenia pamieci dzielonej!\n");
        exit(0);
    }
    else
    {
        printf("[KLIENT] Utworzono pamiec dzielona!\n");
    }
    return shmid;
}

void attach_shared_memory()
{
    shmp = shmat(shmid,0,0);
    if(shmp == NULL)
    {
        perror("[KLIENT] Blad dolaczenia pamieci dzielonej!\n");
        exit(0);
    }
    else
    {
        printf("[KLIENT] Pomyslnie dolaczono pamiec dzielona!\n");
    }
}

int create_semaphores()
{
    semid = semget(ftok("serwer.c",3),2,0666);
    if(semid < 0)
    {
        perror("[KLIENT] Blad tworzenia zbioru semaforow.\n");
    }
    else
    {
        printf("[KLIENT] Poprawnie utworzono zbior semaforow!\n");
    }
    return semid;
}

void program_loop()
{
    int it = 0;
    int value;
    while(it<10)
    {
        unlock_sem_2(semid);
        lock_sem_1(semid);
        value = *shmp;
        printf("Wartosc: %d\n",value);
        int time = rand()%1000001;
        usleep(time);
        it++;
    }
}

void detach_shared_memory()
{
    if(shmdt(shmp)<0)
    {
        perror("[KLIENT] Blad odlaczania pamieci dzielonej!\n");
    }
    else
    {
        printf("[KLIENT] Pomyslnie odlaczono pamiec dzielona!\n");
    }
}

int main(void)
{
    create_shared_memory();
    attach_shared_memory();
    create_semaphores();
    program_loop();
    detach_shared_memory();
    return 0;
}