import java.util.Scanner;

public class OptimizationLagrange {


    private static double e;
    private static double g;
    private static int n;
    private static double[] a;
    private static double[] b;
    private static double[] c;
    private static double[] d;


    public static double f(double x) {
        return 4 * Math.pow(x, 2) - 9 * x + 5.5;
    }

    public static void enterData() {
        boolean end = false;
        while (!end) {
            try {
                System.out.println("\n### Program minimum lokalne funkcji ###");
                System.out.println("### Dla: f(x)=4x^2-9x+5.5 ###");
                System.out.println("\n");
                System.out.print(">> Wprowadź ilość iteracji (Nmax):");
                n = new Scanner(System.in).nextInt();
                a = new double[n];
                b = new double[n];
                c = new double[n];
                d = new double[n];
                System.out.print(">> Wprowadź dolną granicę przedziału zbioru argumentów x ([x0,xn] -> x0):");
                a[0] = new Scanner(System.in).nextDouble();
                System.out.print(">> Wprowadź górną granicę przedziału zbioru argumentów x ([x0,xn] -> xn):");
                b[0] = new Scanner(System.in).nextDouble();
                c[0] = (a[0] + b[0]) / 2;
                System.out.print(">> Wprowadź warunek dokładności - epsilon (e):");
                e = new Scanner(System.in).nextDouble();
                g = 0.001 * e;
                end = true;
            } catch (Exception e) {
                System.out.println("\n[ERROR] Wystapił błąd wpisywania danych!");
                for (int i = 0; i < 500; i++) {
                    System.out.println();
                }
            }
        }
    }

    @SuppressWarnings("Duplicates")
    public static void optimizationMethodLagrange() throws Exception {

        for (int i = 0; i < n; i++) {

            d[i] = 0.5d * ((f(a[i]) * (Math.pow(c[i], 2) - Math.pow(b[i], 2)) + f(c[i]) * (Math.pow(b[i], 2) - Math.pow(a[i], 2)) + f(b[i]) * (Math.pow(a[i], 2) - Math.pow(c[i], 2)))
                    / (f(a[i]) * (c[i] - b[i]) + f(c[i]) * (b[i] - a[i]) + f(b[i]) * (a[i] - c[i])));


            if (b[i] - a[i] < e) {
                System.out.println("[WYNIK - MIN LOKALNE f(x)]: " + d[i]);
                System.exit(0);
            }

            if (i > 0) {
                if (b[i] - a[i] < e || Math.abs(d[i] - d[i - 1]) <= g) {
                    System.out.println("[WYNIK - MIN LOKALNE f(x)]: " + d[i]);
                    System.exit(0);
                }
            }

            if (a[i] < d[i] && d[i] < c[i] && a[i] < c[i] && i < n - 1) {
                if (f(d[i]) < f(c[i])) {
                    a[i + 1] = a[i];
                    c[i + 1] = d[i];
                    b[i + 1] = c[i];
                } else {
                    a[i + 1] = d[i];
                    c[i + 1] = c[i];
                    b[i + 1] = b[i];
                }
            } else {
                if (c[i] < d[i] && d[i] < b[i] && c[i] < b[i] && i < n - 1) {
                    if (f(d[i]) < f(c[i])) {
                        a[i + 1] = c[i];
                        c[i + 1] = d[i];
                        b[i + 1] = b[i];
                    } else {
                        a[i + 1] = a[i];
                        c[i + 1] = c[i];
                        b[i + 1] = d[i];
                    }
                } else {
                    System.out.println("[ERROR] Algorytm nie jest zbieżny!");
                    System.exit(0);
                }
            }
        }

    }

    public static void main(String[] args) {
        OptimizationLagrange.enterData();
        try {
            OptimizationLagrange.optimizationMethodLagrange();
        } catch (Exception e1) {
            System.out.println("[ERROR] Wystąpił błąd obliczeniowy zadania!");
            OptimizationLagrange.enterData();
        }
    }
}
