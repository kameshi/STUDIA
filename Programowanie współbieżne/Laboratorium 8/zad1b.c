#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <pthread.h>

void *function(void *argument){
    return NULL;
}

int main(void)
{
    int i = 0;
    int j = 0;
    struct timespec start, end;
    clock_gettime(CLOCK_MONOTONIC,&start);
    pthread_t tid[100];
    for(;i<100;i++)
    {
        if(pthread_create(&tid[i],NULL,function,NULL)>0)
        {
            perror("[ZAD1 - WATKI] Wystapil blad tworzenia procesu!\n");
        }
    }
    for(;j<100;j++)
    {
        pthread_join(tid[j],NULL);
    }
    clock_gettime(CLOCK_MONOTONIC,&end);
    long int time = end.tv_nsec - start.tv_nsec;
    printf("[ZAD1 - WATKI] Czas operacji: %ld ns.\n",time);
    return 0;
}