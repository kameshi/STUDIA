import java.util.Random;
import java.util.concurrent.ConcurrentSkipListSet;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class CollectConcurrentSkipListSet implements Runnable{

    private int value;
    private String name;
    private ConcurrentSkipListSet<Integer> concurrentSkipListSet;

    public CollectConcurrentSkipListSet(int value, String name, ConcurrentSkipListSet<Integer> concurrentSkipListSet) {
        this.value = value;
        this.name = name;
        this.concurrentSkipListSet = concurrentSkipListSet;
    }

    @Override
    public void run() {
        value = new Random().nextInt(10);
        concurrentSkipListSet.add(value);
        System.out.println(name + " [DODANO]: " + value);
        System.out.println(name + " [WYNIK]: " + concurrentSkipListSet);
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        ConcurrentSkipListSet<Integer> concurrentSkipListSet = new ConcurrentSkipListSet<>();
        for (int i = 0; i < 5; i++) {
            executorService.execute(new CollectConcurrentSkipListSet(i, "Watek: " + i, concurrentSkipListSet));
        }
        executorService.shutdown();
    }
}
