function[wynik] = szereg_ln_x(x,n)
wynik = 0;
    if(x<=-1) || (x>1)
        disp('Zakres wartosci x zawiera się w przedziale (-1,1>!');
    end
    for i=1 : n
        wynik = wynik + (power((-1),(i+1))/i)*power(x-1,i);
    end;
end