function[wynik] = horner(wsp,x)
format long g
%HORNER Funkcja licz�ca warto�� wielomianu w punkcie x dla wspolczynnikow.
%Przyjmuje dwa argumenty: wektor wspo�czynnik�w oraz punkt dla
%kt�rego liczymy warto�� wielomianu.
    wynik = wsp(1);
    for i=1:size(wsp,2)-1
        wynik = wynik * x + wsp(i+1);
    end
end