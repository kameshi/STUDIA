function[wynik] = horner(wsp,x)
format long g
%HORNER Funkcja licz¹ca wartoœæ wielomianu w punkcie x dla wspolczynnikow.
%Przyjmuje dwa argumenty: wektor wspo³czynników oraz punkt dla
%którego liczymy wartoœæ wielomianu.
    wynik = wsp(1);
    for i=1:size(wsp,2)-1
        wynik = wynik * x + wsp(i+1);
    end
end