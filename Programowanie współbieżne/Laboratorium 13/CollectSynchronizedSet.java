import java.util.Collections;
import java.util.HashSet;
import java.util.Random;
import java.util.Set;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class CollectSynchronizedSet implements Runnable {

    private int value;
    private String name;
    private Set<Integer> hashSet;

    public CollectSynchronizedSet(int value, String name, Set<Integer> hashSet) {
        this.value = value;
        this.name = name;
        this.hashSet = hashSet;
    }

    @Override
    public void run() {
        value = new Random().nextInt(10);
        hashSet.add(value);
        System.out.println(name + " [DODANO]: " + value);
        System.out.println(name + " [WYNIK]: " + hashSet);
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        Set<Integer> hashSet = Collections.synchronizedSet(new HashSet<Integer>());
        for (int i = 0; i < 5; i++) {
            executorService.execute(new CollectSynchronizedSet(i, "Watek: " + i, hashSet));
        }
        executorService.shutdown();
    }
}
