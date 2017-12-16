import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.TimeUnit;

public class Zadanie2e implements Runnable{

    @Override
    public void run(){
        try {
            TimeUnit.SECONDS.sleep(1);
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        System.out.println("Zadanie 2e - CachedThreadPool");
    }

    public static void main(String[] args)
    {
        ExecutorService executor = Executors.newCachedThreadPool();
        executor.execute(new Zadanie2e());
        executor.execute(new Zadanie2e());
        executor.execute(new Zadanie2e());
        executor.execute(new Zadanie2e());
        executor.execute(new Zadanie2e());
        executor.execute(new Zadanie2e());
        executor.shutdown();

    }
}