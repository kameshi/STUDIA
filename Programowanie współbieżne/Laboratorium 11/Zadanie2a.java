
public class Zadanie2a implements Runnable {

    @Override
    public void run() {
        System.out.println("Zadanie 2 - Runnable!");
    }

    public static void main(String[] args) {
        new Thread(new Zadanie2a()).start();
    }

}
