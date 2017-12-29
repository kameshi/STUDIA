import java.util.Scanner;

public class OptimizationDividingIntoTwo {

    private static double e;
    private static double a;
    private static double b;

    public static double f(double x) {
        return 4 * Math.cos(x);
    }

    @SuppressWarnings("Duplicates")
    public static void enterData() {
        boolean end = false;
        while (!end) {
            try {
                System.out.println("\n### Program minimum lokalne funkcji ###");
                System.out.println("### Dla: f(x)=4x^2-9x+5.5 ###");
                System.out.println("\n");
                System.out.print(">> Wprowadź dolną granicę przedziału zbioru argumentów x ([x0,xn] -> x0):");
                a = new Scanner(System.in).nextDouble();
                System.out.print(">> Wprowadź górną granicę przedziału zbioru argumentów x ([x0,xn] -> xn):");
                b = new Scanner(System.in).nextDouble();
                System.out.print(">> Wprowadź warunek dokładności - epsilon (e):");
                e = new Scanner(System.in).nextDouble();
                end = true;
            } catch (Exception e) {
                System.out.println("\n[ERROR] Wystapił błąd wpisywania danych!");
                for (int i = 0; i < 500; i++) {
                    System.out.println();
                }
            }
        }
    }

    public static void dividingIntoTwoAlgorithm() {

        while(true) {
            double xl = ((a + b) / 2.0E00) - (e / 2.0E00);
            double xp = ((a + b) / 2.0E00) + (e / 2.0E00);
            System.out.println(xl + " " + xp);
            if (f(xl) >= f(xp)) {
                a = xl;
            }
            else if (f(xl) <= f(xp)) {
                b = xp;
            }
            if (Math.abs(a - b) < e) {
                double result = (a + b) / 2.0E00;
                System.out.println("[WYNIK - MIN LOKALNE f(x)]: " + result);
                break;
            }
        }
    }

    public static void main(String[] args) {
        OptimizationDividingIntoTwo.enterData();
        OptimizationDividingIntoTwo.dividingIntoTwoAlgorithm();
    }

}
