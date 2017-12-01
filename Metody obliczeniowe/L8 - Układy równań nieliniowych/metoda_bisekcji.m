function[c] = metoda_bisekcji(a,b,e)
    format long g
    f = inline(input('Podaj rownanie funkcji f(x): ','s'));
    x(1) = a;
    x(2) = b;
    for i=3:1000
        x(i) = (x(1)+x(2))/2;
        y = f(x(i));
        y1 = f(x(1));
        if abs(y) < e
            c = x(i);
            break;
        end
        if y*y1 > 0
            x(1) = x(i);
        else
            x(2) = x(i);
        end
    end
end