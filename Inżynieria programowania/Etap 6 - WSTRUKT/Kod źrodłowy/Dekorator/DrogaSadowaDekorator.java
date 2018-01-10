import java.time.LocalDateTime;

public class DrogaSadowaDekorator extends MandatDekorator{

    private String wniosek;
    private LocalDateTime dataZlozenia;

    public DrogaSadowaDekorator(MandatInterfejs mandat) {
        super(mandat);
    }

    @Override
    public void dodajNazwe() {

    }

    @Override
    public void dodajKwote() {

    }

    @Override
    public void dodajWystawiajcego() {

    }

    @Override
    public void dodajOrgan() {

    }

    @Override
    public void dodajPobierajcego() {

    }

    @Override
    public void ustalTypMandatuPlatnosc() {

    }

    public void ustalPowodOdmowienia() {

    }

    public void zlozWniosekDoSadu(){

    }
}
