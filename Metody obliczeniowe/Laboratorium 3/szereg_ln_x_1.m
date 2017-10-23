function[wynik] = szereg_ln_x_1(x,n)
wynik = 0;
    if(x>1) || (x<-1)
        disp('Blad');
    end
    for i=1 : n
        wynik = wynik + (power((-1),(i+1))/i)*power(x-1,i);
    end;
end