package a;

import java.util.ArrayList;
import java.util.Scanner;

public class MetodaHornera {

	private static ArrayList<Double> wspolczynniki = new ArrayList<Double>();
	private static Double x;
	private static Double wsp;
	private static Double wynik;
	private static Integer stopien;
	private static Scanner s = new Scanner(System.in);

	public static Double getWsp() {
		return wsp;
	}

	public static void setWsp(Double wsp) {
		MetodaHornera.wsp = wsp;
	}

	public static Integer getStopien() {
		return stopien;
	}

	public static void setStopien(Integer stopien) {
		MetodaHornera.stopien = stopien;
	}

	public static Double getX() {
		return x;
	}

	public static void setX(Double x) {
		MetodaHornera.x = x;
	}

	public static Double getWynik() {
		return wynik;
	}

	public static void setWynik(Double wynik) {
		MetodaHornera.wynik = wynik;
	}

	public static void wprowadzStopien() {
		System.out.print("Podaj stopieñ wielomianu: ");
		setStopien(s.nextInt());
	}

	public static void wprowadzDane() throws Exception {
		System.out.println("Podaj wspolczynniki wielomianu:");
		for (int i = 0; i < getStopien(); i++) {
			System.out.print(">> ");
			setWsp(s.nextDouble());
			wspolczynniki.add(wsp);
		}
		System.out.print(">> (wyraz wolny): ");
		setWsp(s.nextDouble());
		wspolczynniki.add(wsp);
	}

	public static void wprowadzPunkt() {
		System.out.print("Podaj wartosc, dla jakiej chcesz policzyc wielomian: ");
		setX(s.nextDouble());
	}

	public static void wyswietlDane() {
		String st = "";
		for (int i = 0; i < wspolczynniki.size(); i++) {
			if(i==wspolczynniki.size()-1)
			{
				st = new StringBuilder(st).append("("+wspolczynniki.get(i).toString() + ")").toString();
			}
			else
			{
				st = new StringBuilder(st).append("("+wspolczynniki.get(i).toString() + "x^" + (getStopien()-i) + ") + ").toString();
			}
		}
		System.out.println("\nWielomian: " + st);
	}

	public static void obliczHornerem() {
		setWynik(wspolczynniki.get(0));
		for (int i = 0; i < wspolczynniki.size() - 1; i++) {
			setWynik(getWynik() * getX() + wspolczynniki.get(i + 1));
		}
		System.out.println("\nWartosc wielomianu dla x=" + getX() + " to: " + getWynik());
	}

	public static void main(String[] args) throws Exception {
		wprowadzStopien();
		wprowadzDane();
		wprowadzPunkt();
		wyswietlDane();
		obliczHornerem();
	}
}
