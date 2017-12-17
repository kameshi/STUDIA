function [c] = metoda_fibonacii(a, b, e)
format long g
    f = inline(input('Podaj rownanie funkcji f(x): ','s'));
    q(1) = 1;
    q(2) = 1;
    n = 3;
    while 1
        q(n) = q(n - 2) + q(n - 1);
        if ((b - a) / q(n)) >= 2 * e
            n = n + 1; 
        else
            break;
        end
    end
    x1 = b - ((q(n - 1) / q(n)) * (b - a));
    x2 = a + ((q(n - 1) / q(n)) * (b - a));
    while 1
        if f(x1) < f(x2)
            b = x2;
            x2 = x1;
            n = n - 1;
            x1 = b - ((q(n - 1) / q(n)) * (b - a));
        else
            a = x1;
            x1 = x2;
            n = n - 1;
            x2 = a + ((q(n - 1) / q(n)) * (b - a));
        end
        if abs(x2 - x1) < e || n < 3
            c = (x1 + x2) / 2;
            break;
        end
    end
end



