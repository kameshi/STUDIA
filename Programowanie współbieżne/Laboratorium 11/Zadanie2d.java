import java.util.concurrent.ExecutorService;
        import java.util.concurrent.Executors;
        import java.util.concurrent.TimeUnit;

public class Zadanie2d implements Runnable{

    @Override
    public void run(){
        try {
            TimeUnit.SECONDS.sleep(1);
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        System.out.println("Zadanie 2d - FixedThreadPool");
    }

    public static void main(String[] args)
    {
        ExecutorService executor = Executors.newFixedThreadPool(2);
        executor.execute(new Zadanie2d());
        executor.execute(new Zadanie2d());
        executor.execute(new Zadanie2d());
        executor.execute(new Zadanie2d());
        executor.execute(new Zadanie2d());
        executor.execute(new Zadanie2d());
        executor.execute(new Zadanie2d());
        executor.execute(new Zadanie2d());
        executor.shutdown();

    }
}