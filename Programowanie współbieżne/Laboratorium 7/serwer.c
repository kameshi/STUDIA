#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/shm.h>
#include <sys/sem.h>
#include <signal.h>

static struct sembuf op_unlock_1[1] = {{0,1,0}};
static struct sembuf op_lock_2[1] = {{1,-1,0}};

int run = 1;
int semid;
int shmid;
char *shmp;

void unlock_sem_1(int semid)
{
    if(semop(semid,&op_unlock_1[0],1)<0)
    {
        perror("[SERWER] Blad odblokowania semafora 1!\n");
    }
    else
    {
        printf("[SERWER] Odblokowano semafor 1\n");
    }
}

void lock_sem_2(int semid)
{
    if(semop(semid,&op_lock_2[0],1)<0)
    {
        perror("[SERWER] Blad blokowania semafora! 2\n");
    }
    else
    {
        printf("[SERWER] Zblokowano semafor 2\n");
    }
}

void close_serwer_handler(int nr_sig)
{
    run = 0;
    printf("[SERWER] Zamykam serwer!\n");
    if(shmdt(shmp)<0)
    {
        perror("[SERWER] Blad odlaczania pamieci dzielonej!\n");
    }
    else
    {
        printf("[SERWER] Pomyslnie odlaczono pamiec dzielona!\n");
    }
    if(semctl(semid,0,IPC_RMID,0)<0)
    {
        perror("[SERWER] Blad usuwania zbioru semaforow!\n");
    }
    else
    {
        printf("[SERWER] Pomyslnie usunieto zbior semaforow!\n");
    }
    if(shmctl(shmid,IPC_RMID,NULL)<0)
    {
        perror("[SERWER] Blad usuwania pamieci dzielonej!\n");
    }
    else
    {
        printf("[SERWER] Pomyslnie usunieto pamiec dzielona!\n");
    }
    exit(1);
}

int create_shared_memory()
{
    shmid = shmget(ftok("serwer.c",3),sizeof(int),IPC_CREAT|IPC_EXCL|0666);
    if(shmid == -1)
    {
        perror("[SERWER] Blad tworzenia pamieci dzielonej!\n");
    }
    else
    {
        printf("[SERWER] Utworzono pamiec dzielona!\n");
    }
    return shmid;
}

void attach_shared_memory()
{
    shmp = shmat(shmid,0,0);
    if(shmp == NULL)
    {
        perror("[SERWER] Blad dolaczenia pamieci dzielonej!\n");
    }
    else
    {
        printf("[SERWER] Pomyslnie dolaczono pamiec dzielona!\n");
    }
}

int create_semaphores()
{
    semid = semget(ftok("serwer.c",3),2,IPC_CREAT|0666);
    if(semid < 0)
    {
        perror("[SERWER] Blad tworzenia zbioru semaforow.\n");
    }
    else
    {
        printf("[SERWER] Poprawnie utworzono zbior semaforow!\n");
    }
    return semid;
}

void program_loop()
{
    srand(getpid());
    int i = 1;
    while(run)
    {
        lock_sem_2(semid);
        int time = rand()%1000001;
        printf("Czekam: %d\n",time);
        *shmp = i;
        i++;
        unlock_sem_1(semid);
        usleep(time);
    }
}

int main(void)
{
    signal(SIGINT,close_serwer_handler);
    create_shared_memory();
    attach_shared_memory();
    create_semaphores();
    program_loop();
    return 0;
}