function[c] = metoda_zlotego_podzialu(a,b,e)
    f = inline(input('Podaj rownanie funkcji f(x): ','s'));
    k = (sqrt(5)-1)/2;
    xl = b-k*(b-a); 
    xp = a+k*(b-a);
    while 1
        if f(xl) < f(xp)
            b = xp;
            xp = xl;
            xl = b-k*(b-a); 
        end
        if f(xl) > f(xp)
            a = xl;
            xl = xp;
            xp = a+k*(b-a);
        end
        if abs(a-b) < e
            c = (a+b)/2;
            break;
        end
    end 
end
        