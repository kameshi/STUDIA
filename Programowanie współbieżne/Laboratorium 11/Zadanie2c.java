import java.util.concurrent.*;

public class Zadanie2c implements Callable<String>{
    @Override
    public String call(){
        return "Zadanie 3 - Callable";
    }

    public static void main(String[] args) throws ExecutionException, InterruptedException {
        ExecutorService service = Executors.newSingleThreadExecutor();
        for(int i=0;i<10;i++)
        {
            Future<String> future = service.submit(new Zadanie2c());
            System.out.println(future.get());
        }
        service.shutdown();
    }
}
