#include <stdio.h>
#include <unistd.h>
#include <pthread.h>

void clear(void *argument)
{
    int *n = (int *)argument;
    printf("\n[ZAD3 - CLEAR] Czyszczenie numeru: %d\n\n",*n);
}

void *pthread_function_1(void *argument)
{
    printf("[ZAD3 - WATEK 1] Start!\n");
    pthread_t tid = *(pthread_t *)argument;
    int param = 1;
    pthread_cleanup_push(clear,&param);
    sleep(2);
    printf("[ZAD3 - WATEK 1] WYKONANO SLEEP 2s!\n");
    if(pthread_cancel(tid) == 0)
    {
        printf("[ZAD3 - WATEK 1] USUNIETO WATEK 2!\n");
    }
    else
    {
        printf("[ZAD3 - WATEK 1] NIE MOZNA USUNAC WATKU 2!\n");
    }
    sleep(2);
    printf("[ZAD3 - WATEK 1] WYKONANO SLEEP 2s!\n");
    if(pthread_cancel(tid) == 0)
    {
        printf("[ZAD3 - WATEK 1] USUNIETO WATEK 2!\n");
    }
    else
    {
        printf("[ZAD3 - WATEK 1] NIE MOZNA USUNAC WATKU 2 BO NIE ISTNIEJE!\n");
    }
    pthread_cleanup_pop(1);
    return NULL;
}

void *pthread_function_2(void *argument)
{
    printf("[ZAD3 - WATEK 2] Start!\n");
    int oldstate;
    int param = 2;
    pthread_cleanup_push(clear,&param);
    printf("[ZAD3 - WATEK 2] USUWANIE ZABLOKOWANE!\n");
    pthread_setcancelstate(PTHREAD_CANCEL_DISABLE,&oldstate);
    sleep(3);
    printf("[ZAD3 - WATEK 2] WYKONANO SLEEP 3s!\n");
    printf("[ZAD3 - WATEK 2] USUWANIE ODBLOKOWANE!\n");
    pthread_setcancelstate(PTHREAD_CANCEL_ENABLE,&oldstate);
    sleep(2);         
    printf("[[ZAD3 - WATEK 2] WYKONANO SLEEP 2s!\n");
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