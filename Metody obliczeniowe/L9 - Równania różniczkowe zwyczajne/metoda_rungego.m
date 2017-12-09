function[wynik] = metoda_rungego(x0, y0, h, n)
    f = inline(input('Podaj rownanie funkcji f(y,t):','s')); 
    xi = zeros(n+1,1);
    yi = zeros(n+1,1);
    xi(1) = x0;
    yi(1) = y0;
    for i = 2:n+1
        k1 = h * f(xi(i-1), yi(i-1));
        k2 = h * f(xi(i-1) + 0.5*h, yi(i-1) + 0.5*k1);
        k3 = h * f(xi(i-1) + 0.5*h, yi(i-1) + 0.5*k2);
        k4 = h * f(xi(i-1) + h, yi(i-1) + k3);
        xi(i) = xi(i-1) + h;
        yi(i) = yi(i-1)+(1/6) * (k1 + 2*k2 + 2*k3 + k4);
        disp([xi(i),yi(i)]);
    end
    wynik = yi(n+1);
    plot(xi,yi,'o',xi,yi);
    xlabel('x');
    ylabel('y');
    grid on;
end