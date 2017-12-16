import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.TimeUnit;

public class Zadanie2f implements Runnable {

    @Override
    public void run() {
        try {
            TimeUnit.SECONDS.sleep(1);
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        System.out.println("Zadanie 2f - SingleThreadExecutor");
    }

    public static void main(String[] args) {
        ExecutorService executor = Executors.newSingleThreadExecutor();
        executor.execute(new Zadanie2f());
        executor.execute(new Zadanie2f());
        executor.execute(new Zadanie2f());
        executor.execute(new Zadanie2f());
        executor.execute(new Zadanie2f());
        executor.execute(new Zadanie2f());
        executor.shutdown();

    }
}