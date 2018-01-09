import java.util.Random;
import java.util.concurrent.CopyOnWriteArrayList;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class CollectCopyOnWriteArraySet implements Runnable{

    private int value;
    private String name;
    private CopyOnWriteArrayList<Integer> copyOnWriteArrayList;

    public CollectCopyOnWriteArraySet(int value, String name, CopyOnWriteArrayList<Integer> copyOnWriteArrayList) {
        this.value = value;
        this.name = name;
        this.copyOnWriteArrayList = copyOnWriteArrayList;
    }

    @Override
    public void run() {
        value = new Random().nextInt(10);
        copyOnWriteArrayList.add(value);
        System.out.println(name + " [DODANO]: " + value);
        System.out.println(name + " [WYNIK]: " + copyOnWriteArrayList);
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        CopyOnWriteArrayList<Integer> copyOnWriteArrayList = new CopyOnWriteArrayList<>();
        for (int i = 0; i < 5; i++) {
            executorService.execute(new CollectCopyOnWriteArraySet(i, "Watek: " + i, copyOnWriteArrayList));
        }
        executorService.shutdown();
    }
}
