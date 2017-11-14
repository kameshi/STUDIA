import java.util.Scanner;

public class AproksymacjaMNK {
	private static double[][] pkt;
	private static double S0;
	private static double S1;
	private static double S2;
	private static double T0;
	private static double T1;
	private static double a0;
	private static double a1;
	private static int rozmiar;
	private static Scanner in = new Scanner(System.in);

	public static double[][] wprowadzDane() {
		boolean koniec = false;
		String tmpX;
		String tmpY;
		String tmpRozmiar;
		while (!koniec) {
			try {
				System.out.println("### PROGRAM OBLICZAJĄCY FUNKCJĘ APROKSYMUJĄCĄ LINIOWĄ ###\n");
				System.out.print(">> ILOŚĆ PUNKTÓW: ");
				tmpRozmiar = in.next();
				rozmiar = Integer.parseInt(tmpRozmiar);
				pkt = new double[rozmiar][2];
				System.out.println("## PODAWANIE WSPÓŁRZĘDNYCH PUNKTÓW ##\n");
				for (int i = 0; i < rozmiar; i++) {
					System.out.print("x"+i+">> ");
					tmpX = in.next();
					pkt[i][0] = Double.parseDouble(tmpX);
					System.out.print("y"+i+">> ");
					tmpY = in.next();
					pkt[i][1] = Double.parseDouble(tmpY);
					if (i == rozmiar-1) {
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
		return pkt;
	}

	public static void wyznaczFunkcje(double[][] pkt) {
		S0 = (double) pkt.length;
		for (int i = 0; i < pkt.length; i++) {
			S1 += pkt[i][0];
			S2 += Math.pow(pkt[i][0], 2);
			T0 += pkt[i][1];
			T1 += pkt[i][0] * pkt[i][1];
		}
		a1 += ((T1 * S0) / (-(Math.pow(S1, 2)) + S0 * S2)) - ((S1 * T0) / (-(Math.pow(S1, 2)) + S0 * S2));
		a0 += (T0 / S0) - ((S1 * a1) / S0);
		System.out.println("\n## FUNKCJA INTERPOLUJĄCA LINIOWA:");
		System.out.println("m=1 -> Q(x): " + a1 + "x + " + a0);
	}

	public static void main(String[] args) {
		double[][] dane = wprowadzDane();
		wyznaczFunkcje(dane);
	}
}