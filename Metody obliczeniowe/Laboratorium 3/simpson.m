function[y] = simpson(a,b,n,f)
format long g
    if (n<2) || mod(n,2)
        disp('Liczba podprzedzialow musi byc parzysta oraz >=2')
        return 
    end
    h=(b-a)/n;
    y=feval(f,a) +  feval(f,b);
    for i = 1 : n-1
        if mod(i,2)
            y=y+4*feval(f,a+i*h);
        else
            y=y+2*feval(f,a+i*h);
        end
    end
    y=h*y/3;
end 
