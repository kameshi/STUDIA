#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

int main(void)
{
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
