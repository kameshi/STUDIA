import java.time.LocalDateTime;

public class KredytowanyDekorator extends MandatDekorator{

    private Integer numerKonta;
    private LocalDateTime zaksiegowaniePrzelewu;
    private String bank;
    private Double zaksiegowanaKwota;

    public KredytowanyDekorator(MandatInterfejs mandat) {
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

    public void dodajNumerKonta(){

    }

    public LocalDateTime getZaksiegowaniePrzelewu() {
        return zaksiegowaniePrzelewu;
    }

    public void setZaksiegowaniePrzelewu(LocalDateTime zaksiegowaniePrzelewu) {
        this.zaksiegowaniePrzelewu = zaksiegowaniePrzelewu;
    }

    public String getBank() {
        return bank;
    }

    public void setBank(String bank) {
        this.bank = bank;
    }

    public Double getZaksiegowanaKwota() {
        return zaksiegowanaKwota;
    }

    public void setZaksiegowanaKwota(Double zaksiegowanaKwota) {
        this.zaksiegowanaKwota = zaksiegowanaKwota;
    }

}

