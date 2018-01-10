import java.time.LocalDateTime;

public class Mandat implements MandatInterfejs{

    private Long id;
    private Double kwota;
    private String typPlatnosci;
    private LocalDateTime dataWystawienia;
    private String osobaWystawiajca;
    private String daneOsoby;
    private String podstawaPrawna;

    public Mandat(Long id, Double kwota, String typPlatnosci, LocalDateTime dataWystawienia, String osobaWystawiajca, String daneOsoby, String podstawaPrawna) {
        this.id = id;
        this.kwota = kwota;
        this.typPlatnosci = typPlatnosci;
        this.dataWystawienia = dataWystawienia;
        this.osobaWystawiajca = osobaWystawiajca;
        this.daneOsoby = daneOsoby;
        this.podstawaPrawna = podstawaPrawna;
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

    @Override
    public void dodajPodstawePrawna() {

    }
}
