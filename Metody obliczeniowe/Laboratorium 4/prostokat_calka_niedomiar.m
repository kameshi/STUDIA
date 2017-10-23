function[y] = prostokat_calka_niedomiar(a,b,n,f)
format long g
    if (n<2)
        disp('Liczba podprzedzialow musi byc >=2')
        return 
    end
    h=(b-a)/n;
    y=feval(f,a*h);
    for i = 1 : n-1
            y=y+feval(f,a+i*h);
    end
    y=h*y;
end 