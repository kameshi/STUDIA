function[c] = metoda_stycznych(a,b,e)
    format long g
    f = inline(input('Podaj rownanie funkcji f(x):','s'));
    f1 = inline(input('Podaj rownanie pierwszej pochodnej: ','s'));
    f2 = inline(input('Podaj rownanie drugiej pochodnej: ','s'));
    x = (a+b)/2;
    if (f1(x) * f2(x)) < 0
        x(1) = a;
    else
        error('f1(x) * f2(x) musi byc < 0 !');
    end
    for i=2:1000
        x(i) = x(i-1) - f(x(i-1))/f1(x(i-1));
        if abs(f(x(i))) < e
            c = x(i);
            break;
        end
    end
end