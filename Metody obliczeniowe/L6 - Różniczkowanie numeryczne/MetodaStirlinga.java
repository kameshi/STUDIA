import java.util.Scanner;

public class MetodaStirlinga {
	private static double punkt = 0D;
	private static double[][] pkt;
	private static double[] wsp = { 1.0, -1.0 / 6.0, 1.0 / 30.0 };
	private static int rozmiar = 0;
	private static double h = 0D;
	private static double fx = 0D;
	private static double wynik = 0D;
	private static Scanner in = new Scanner(System.in);

	public static void wprowadzDane() {
		boolean koniec = false;
		String tmpX;
		String tmpY;
		String tmpRozmiar;
		while (!koniec) {
			try {
				System.out.println("### PROGRAM OBLICZAJĄCY PRZYBLIŻONĄ WARTOŚĆ PIERWSZEJ POCHODNEJ ###\n");
				System.out.print(">> ILOŚĆ PUNKTÓW: ");
				tmpRozmiar = in.next();
				rozmiar = Integer.parseInt(tmpRozmiar);
				pkt = new double[rozmiar][rozmiar + 1];
				System.out.println("## PODAWANIE WSPÓŁRZĘDNYCH ##\n");
				for (int i = 0; i < rozmiar; i++) {
					System.out.print("x" + i + ">> ");
					tmpX = in.next();
					pkt[i][0] = Double.parseDouble(tmpX);
					System.out.print("y" + i + ">> ");
					tmpY = in.next();
					pkt[i][1] = Double.parseDouble(tmpY);
					if (i == rozmiar - 1) {
						koniec = true;
					}
				}
			} catch (Exception e) {
				System.out.println("\n[BŁAD!] BŁĘDNIE WPISANO DANE!\n");
				for (int i = 0; i < 500; i++) {
					System.out.println("\n");
				}
			}
		}
	}

	public static void roznicaCentralna() {
		double x = rozmiar / 2.0 + 0.5;
		punkt = pkt[(int) x - 1][0];
		h = pkt[1][0] - pkt[0][0];
		for (int j = 2; j <= rozmiar; j++) {
			for (int i = rozmiar - j; i >= 0; i--) {
				pkt[i][j] = pkt[i + 1][j - 1] - pkt[i][j - 1];
			}
		}
	}

	public static void wyznaczPochodna() {
		int j = -1;
		for (int i = 1; i < rozmiar - 1; i += 2) {
			fx += wsp[++j] * (0.5 * (pkt[(rozmiar - (i + 1)) / 2][i + 1] + pkt[((rozmiar - (i + 1)) / 2) + 1][i + 1]));
		}
		wynik = (1 / h) * fx;
		System.out.println("\nWartość pierwszej pochodnej w punkcie: " + punkt + " wynosi: " + wynik);
	}

	public static void main(String[] args) {
		wprowadzDane();
		roznicaCentralna();
		wyznaczPochodna();
	}
}