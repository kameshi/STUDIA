function[y] = monte_carlo_calka(a,b,n,f)
format long g
    if (n<=0)
        disp('Liczba podprzedzialow musi byc >=1')
        return 
    end
    y=0;
    h=b-a;
    for i=1 : n
        y=y+feval(f,a+rand*h);
    end
    y=(h*y)/n;
end 
