#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <time.h>
#include <sys/wait.h>

int main(void)
{
    int childpid;
    int i = 0;
    int j = 0;
    struct timespec start, end;
    clock_gettime(CLOCK_MONOTONIC,&start);
    for(;i<100;i++)
    {
        if((childpid = fork()) == -1)
        {
            perror("[ZAD1 - PROCESY] Nie moge forknac!\n");
            exit(1);
        }
        else
        {
            if(childpid == 0)
            {
                exit(0);
            }
        }
    }
    for(;j<100;j++)
    {
        wait(NULL);
    }
    clock_gettime(CLOCK_MONOTONIC,&end);
    long int time = end.tv_nsec - start.tv_nsec;
    printf("[ZAD1 - PROCESY] Czas operacji: %ld ns.\n",time);
    return 0;
}