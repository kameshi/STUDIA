function[c] = metoda_dychotomii(a,b,h,e)
    f = inline(input('Podaj rownanie funkcji f(x): ','s'));
    while 1
        xl = (a+b)/2 - h/2;
        xp = (a+b)/2 + h/2;
        if f(xl) >= f(xp)
            a = xl;
        end
        if f(xl) <= f(xp) 
            b = xl;
        end
        if abs(a-b) < e
            c = (a+b)/2;
            break;
        end
    end 
end
        