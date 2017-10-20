#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <unistd.h>

int main(void)
{
	int childpid;
	int status;
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
			sleep(2);
			exit(2);
		}
		else
		{
			printf("Proces macierzysty o pidzie %d i dziecku %d\n",getpid(),childpid);
			wait(&status);
			printf("Koniec pracy PROCESU POTOMNEGO!\n");
			printf("STATUS: %d\n",status);
			/*printf("STATUS WEXITSTATUS: %d\n",WEXITSTATUS(status));*/
		}
	}
	exit(0);
}
