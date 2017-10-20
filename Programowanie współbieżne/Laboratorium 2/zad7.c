#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <unistd.h>
#include <signal.h>

void obsluga_zakonczenia_dziecka(int nr_sig)
{
	printf("Rodzic juz sie dowiedzial o zakonczeniu procesu: %d\n",wait(NULL));
}


int main(void)
{
	signal(SIGCHLD,obsluga_zakonczenia_dziecka);
	int childpid;
	printf("Startuje proces macierzysty pid: %d\n",getpid());
	if((childpid = fork())==-1)
	{
		perror("Nie moge forknac!");
		exit(1);
	}
	else
	{
		if(childpid==0)
		{
			printf("Proces potomny o pidzie %d z rodzica %d\n",getpid(),getppid());
		}
		else
		{
			sleep(2);
			printf("Proces macierzysty o pidzie %d i dziecku %d\n",getpid(),childpid);
		}
	}
	exit(0);
}
