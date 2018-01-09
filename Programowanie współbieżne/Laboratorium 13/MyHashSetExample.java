import java.util.HashSet;
import java.util.Random;
import java.util.Set;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

class ExampleHashSet {

    private Set<Integer> hashSet = new HashSet<>();

    public synchronized String addValueToSet(Integer value) {
        hashSet.add(value);
        return "[DODANO]: " + value;
    }

    public synchronized String removeValueFromSet(Integer value) {
        hashSet.remove(value);
        return "[USUNIETO]: " + value;
    }

    public synchronized String getSetToStringFormat() {
        return hashSet.toString();
    }
}

public class MyHashSetExample implements Runnable {

    private int value;
    private String name;
    private ExampleHashSet exampleHashSet;

    public MyHashSetExample(int value, String name, ExampleHashSet exampleHashSet) {
        this.value = value;
        this.name = name;
        this.exampleHashSet = exampleHashSet;
    }

    @Override
    public void run() {
        value = new Random().nextInt(11);
        System.out.println(name + " " + exampleHashSet.addValueToSet(value));
        System.out.println(name + " [WYNIK]: " + exampleHashSet.getSetToStringFormat());
        if (value == 10) {
            System.out.println(name + " " + exampleHashSet.removeValueFromSet(value));
            System.out.println(name + " [WYNIK]: " + exampleHashSet.getSetToStringFormat());
        }
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        ExampleHashSet exampleHashSet = new ExampleHashSet();
        for (int i = 0; i < 5; i++) {
            executorService.execute(new MyHashSetExample(i, "Watek: " + i, exampleHashSet));
        }
        executorService.shutdown();
    }
}