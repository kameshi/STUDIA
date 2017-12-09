function[c] = metoda_eulera(a,h,n)
    f = inline(input('Podaj rownanie funkcji f(y,t):','s'));
    x = ((1:n)-1)*h;
    disp(x);
    y = size(x);
    y(1) = a;
    for i = 2:n
        y(i) = y(i-1) + h * f(x(i-1),y(i-1));
        disp(y(i));
    end
    disp(y(n));
    c = y(n);
    plot(x,y,'o',x,y);
end
    