#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <pthread.h>
#include <string.h>

pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER;
pthread_once_t control = PTHREAD_ONCE_INIT;
pthread_key_t key;

struct structure
{
    char * text;
    int number;
};

void create_key()
{
    if(pthread_key_create(&key,free) != 0)
    {
        perror("[ZAD2] Blad tworzenia klucza!\n");
    }
    else
    {
        printf("[ZAD2] Stworzono klucz!\n");
    }
}

void delete_key()
{
    if(pthread_key_delete(key) != 0)
    {
        perror("[ZAD2] Blad usuwania klucza!\n");
    }
    else
    {
        printf("[ZAD2] Usunieto klucz!\n");
    }
}

void *pthread_function(void *argument)
{
    pthread_once(&control,create_key);
    struct structure *structure = argument;
    pthread_setspecific(key,structure->text);
    pthread_mutex_unlock(&mutex);
    sleep(10);
    printf("[ZAD2] %s numer: %d\n",(char*)pthread_getspecific(key),structure->number);
    return NULL;
}

int main(void)
{
    int i = 0;
    int j = 0;
    pthread_t tid[5];
    for(;i<5;i++)
    {
        sleep(1);
        pthread_mutex_lock(&mutex);
        struct structure s;
        s.number = i+1;
        char text[20];
        sprintf(text,"Watek: %d",i+1);
        s.text = malloc(sizeof(text));
        strcpy(s.text,text);
        if(pthread_create(&tid[i],NULL,pthread_function,&s)>0)
        {
            perror("[ZAD2] Wystapil blad tworzenia watku!\n");
        }
    }
    for(;j<5;j++)
    {
        if(pthread_join(tid[j],NULL)>0)
        {
            perror("[ZAD2] Blad oczekiwania na zakonczenie watku!\n");
        }
    }
    delete_key();
    pthread_mutex_destroy(&mutex);
    return 0;
}


