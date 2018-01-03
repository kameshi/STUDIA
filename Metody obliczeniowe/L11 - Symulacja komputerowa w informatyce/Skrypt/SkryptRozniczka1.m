figure;
hold on;
for i=1:10
    war_pocz = i;
    sim('rozniczka1');
    plot(tout,x);
end