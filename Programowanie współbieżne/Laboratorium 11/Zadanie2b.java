public class Zadanie2b extends Thread{

    @Override
    public void run() {
        System.out.println("Zadanie 2 - Thread!");
    }

    public static void main(String[] args) {
        new Thread(new Zadanie2b()).start();
    }

}
