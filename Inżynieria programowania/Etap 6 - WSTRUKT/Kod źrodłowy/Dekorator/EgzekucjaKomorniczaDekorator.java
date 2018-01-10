public class EgzekucjaKomorniczaDekorator extends MandatDekorator{

    private String komornikSadowy;
    private String podstawaPrawna;
    private String zwloka;

    public EgzekucjaKomorniczaDekorator(MandatInterfejs mandat) {
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

    public void zlozWniosek(){

    }

    public String getKomornikSadowy() {
        return komornikSadowy;
    }

    public void setKomornikSadowy(String komornikSadowy) {
        this.komornikSadowy = komornikSadowy;
    }

    public String getPodstawaPrawna() {
        return podstawaPrawna;
    }

    public void setPodstawaPrawna(String podstawaPrawna) {
        this.podstawaPrawna = podstawaPrawna;
    }

    public String getZwloka() {
        return zwloka;
    }

    public void setZwloka(String zwloka) {
        this.zwloka = zwloka;
    }


}
