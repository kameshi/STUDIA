#include <stdio.h>
#include <unistd.h>
#include <pthread.h>

void clear(void *argument)
{
    int *n = (int *)argument;
    printf("[ZAD3] Czyszczenie numeru: %d\n",*n);
}

void *pthread_function_1(void *argument)
{
    printf("[ZAD3] Start WATEK 1!\n");
    pthread_t tid = *(pthread_t *)argument;
    int param = 1;
    pthread_cleanup_push(clear,&param);
    sleep(2);
    printf("[ZAD3] WATEK 1 PO SLEEP 1:\n");
    pthread_cancel(tid);
    sleep(2);
    printf("[ZAD3] WATEK 1 PO SLEEP 2:\n");
    pthread_cancel(tid);
    pthread_cleanup_pop(1);
    return NULL;
}

void *pthread_function_2(void *argument)
{
    printf("[ZAD3] Start WATEK 2!\n");
    int oldstate;
    int param = 2;
    pthread_cleanup_push(clear,&param);
    pthread_setcancelstate(PTHREAD_CANCEL_DISABLE,&oldstate);
    sleep(3);
    printf("[ZAD3] WATEK 2 PO SLEEP 1:\n");
    pthread_setcancelstate(PTHREAD_CANCEL_ENABLE,&oldstate);
    sleep(2);         
    printf("[ZAD3] WATEK 2 PO SLEEP 2:\n");
    pthread_cleanup_pop(0);
    return NULL;                        
}

int main(void)
{
    pthread_t tid1;
    pthread_t tid2;
    if(pthread_create(&tid2,NULL,pthread_function_2,NULL)>0)
    {
        perror("[ZAD3] Wystapil blad tworzenia watku 2!\n");
    }
    if(pthread_create(&tid1,NULL,pthread_function_1,&tid2)>0)
    {
        perror("[ZAD3] Wystapil blad tworzenia watku 1!\n");
    }
    if(pthread_join(tid1,NULL)>0)
    {
        printf("[ZAD3] Blad oczekiwania na zakonczenie watku 1!\n");
    }
    if(pthread_join(tid2,NULL)>0)
    {
        printf("[ZAD3] Blad oczekiwania na zakonczenie watku 2!\n");
    }
    return 0;
}