import java.text.DecimalFormat;
import java.util.Scanner;

public class MethodRungeKutty {

    private static double[][] xi;
    private static double[][] yi;
    private static double x0;
    private static double xn;
    private static double y0;
    private static double h;
    private static DecimalFormat dfx = new DecimalFormat("#.#");
    private static DecimalFormat dfy = new DecimalFormat("#.####");

    public static double function(double x, double y) {
        return x + Math.sin((y + 1) / Math.sqrt(13));
    }

    public static void enterData() {
        boolean end = false;
        while (!end) {
            try {
                System.out.println("\n### Program obliczający równanie różniczkowe zwyczaje metodą Rungego-Kuttego rzędu IV ###");
                System.out.println("### Dla: y'(x) = x + sin((y(x)+1)/sqrt(13)) ###");
                System.out.println("\n");
                System.out.print(">> Wprowadź dolną granicę przedziału zbioru argumentów x ([x0,xn] -> x0):");
                x0 = new Scanner(System.in).nextDouble();
                System.out.print(">> Wprowadź górną granicę przedziału zbioru argumentów x ([x0,xn] -> xn):");
                xn = new Scanner(System.in).nextDouble();
                System.out.print(">> Wprowadź warunek początkowy y(x0):");
                y0 = new Scanner(System.in).nextDouble();
                System.out.print(">> Wprowadź wartość skoku (h):");
                h = new Scanner(System.in).nextDouble();
                end = true;
            } catch (Exception e) {
                System.out.println("\n[ERROR] Wystapił błąd wpisywania danych!");
                for (int i = 0; i < 500; i++) {
                    System.out.println();
                }
            }
        }
    }

    public static void algorithmRK4() throws Exception {
        double n = (xn - x0) / h;
        xi = new double[(int) n + 1][1];
        yi = new double[(int) n + 1][1];
        xi[0][0] = x0;
        yi[0][0] = y0;
        System.out.println("   x   |   y   ");
        System.out.println("---------------");
        System.out.println(dfx.format(xi[0][0]) + " \t " + dfy.format(yi[0][0]));
        for (int i = 1; i < n + 1; i++) {
            double k1 = h * function(xi[i - 1][0], yi[i - 1][0]);
            double k2 = h * function(xi[i - 1][0] + 0.5 * h, yi[i - 1][0] + 0.5 * k1);
            double k3 = h * function(xi[i - 1][0] + 0.5 * h, yi[i - 1][0] + 0.5 * k2);
            double k4 = h * function(xi[i - 1][0] + h, yi[i - 1][0] + k3);
            xi[i][0] = xi[i - 1][0] + h;
            yi[i][0] = yi[i - 1][0] + ((1.0 / 6.0) * (k1 + (2 * k2) + (2 * k3) + k4));
            System.out.println(dfx.format(xi[i][0]) + " \t " + dfy.format(yi[i][0]));
        }
        System.out.println("\nWynik: " + dfy.format(yi[(int)n][0]));
    }

    public static void main(String[] args) {
        enterData();
        try {
            algorithmRK4();
        } catch (Exception e) {
            System.out.println("\n[ERROR] Wystąpił błąd obliczeniowy dla podanych danych! Spróbuj ponownie!");
            enterData();
        }
    }
}
