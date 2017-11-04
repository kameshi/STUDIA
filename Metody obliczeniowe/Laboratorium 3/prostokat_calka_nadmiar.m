function[y] = prostokat_calka_nadmiar(a,b,n,f)
format long g
    if (n<2)
        disp('Liczba podprzedzialow musi byc >=2')
        return 
    end
    h=(b-a)/n;
    y=0;
    for i = 1 : n
            y=y+feval(f,a+i*h);
    end
    y=h*y;
end 