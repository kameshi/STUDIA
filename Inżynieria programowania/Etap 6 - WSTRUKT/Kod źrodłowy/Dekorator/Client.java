import java.util.Random;

interface Fine {
    void getName();

    void addCost(Double cost);
}

class Penalty implements Fine {

    Integer id = new Random().nextInt(1000000);

    @Override
    public void getName() {
        System.out.print("Mandat [ID]: " + id);
    }

    @Override
    public void addCost(Double cost) {
        System.out.print(" [KWOTA MANDATU]: " + cost);
    }
}

abstract class FineDecorator implements Fine {

    protected final Fine specificFine;

    public FineDecorator(Fine specificFine) {
        this.specificFine = specificFine;
    }

    public void getName() {
        specificFine.getName();
    }

    public void addCost(Double cost) {
        specificFine.addCost(cost);
    }

}

class PaymentTypeFineDecorator extends FineDecorator {

    public PaymentTypeFineDecorator(Fine specificFine) {
        super(specificFine);
    }

    @Override
    public void getName() {
        specificFine.getName();
        setTypePayment(specificFine);
    }

    @Override
    public void addCost(Double cost) {
        specificFine.addCost(cost);
    }

    private void setTypePayment(Fine specificFine) {
        System.out.print(" [TYP PLATNOSCI]: gotówkowy");
    }
}

class GeneralTypeFineDecorator extends FineDecorator {

    public GeneralTypeFineDecorator(Fine specificFine) {
        super(specificFine);
    }

    @Override
    public void getName() {
        specificFine.getName();
        setNameType(specificFine);
    }

    @Override
    public void addCost(Double cost) {
        specificFine.addCost(cost);
    }

    private void setNameType(Fine specificFine) {
        System.out.print(" [TYP]: drogowy");
    }
}

class PenaltyPointFineDecorator extends FineDecorator {

    public PenaltyPointFineDecorator(Fine specificFine) {
        super(specificFine);
    }

    @Override
    public void getName() {
        specificFine.getName();
        addPoints(specificFine, 10);
    }

    @Override
    public void addCost(Double cost) {
        specificFine.addCost(cost);
    }

    private void addPoints(Fine specificFine, int points) {
        System.out.print(" [PUNKTY KARNE]: " + points);
    }
}

class PaymentTimeFineDecorator extends FineDecorator {

    public PaymentTimeFineDecorator(Fine specificFine) {
        super(specificFine);
    }

    @Override
    public void getName() {
        specificFine.getName();
        addTimeToPay(specificFine, 14);
    }

    @Override
    public void addCost(Double cost) {
        specificFine.addCost(cost);
    }

    private void addTimeToPay(Fine specificFine, int days) {
        System.out.print(" [ILOSC DNI NA SPLATE]: " + days);
    }

}

public class Client {
    public static void main(String[] args) {
        Fine fine = new Penalty();
        fine = new PaymentTimeFineDecorator(new PenaltyPointFineDecorator(new PaymentTypeFineDecorator(new GeneralTypeFineDecorator(fine))));
    }

}
